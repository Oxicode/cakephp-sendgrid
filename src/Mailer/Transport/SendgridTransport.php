<?php
namespace Sendgrid\Mailer\Transport;

use Cake\Network\Exception\InternalErrorException;
use Cake\Core\Configure;
use Cake\Mailer\AbstractTransport;
use Cake\Mailer\Email;
use Cake\Network\Http\Client;

class SendgridTransport extends AbstractTransport
{
    protected $_defaultConfig = [
        'api_key' => null,
        'host' => 'api.sendgrid.com',
        'scheme' => 'https',
        'user_agent' => 'CakePHP Sendgrid Plugin'
    ];

    protected $_request = [
        'from' => [],
        'content' => [],
        'personalizations' => [],
    ];

    public function addContents(Email $data) {

        if ($data->getEmailFormat() === 'both' || $data->getEmailFormat() === 'text') {
            $this->_request['content'][] = ['type' => 'text/plain', 'value' => $data->message('text')];
        }

        if ($data->getEmailFormat() === 'both' || $data->getEmailFormat() === 'html') {
            $this->_request['content'][] = ['type' => 'text/html', 'value' => $data->message('html')];
        }

    }

    public function addFrom($recipient) {
        $this->_request['from']['email'] = array_keys($recipient)[0];
        $this->_request['from']['name'] = array_values($recipient)[0];
    }

    public function addRecipients($recipient, $address = []) {
        foreach ($address as $key => $value) :
            $user = [
                'email' => $key,
            ];

            if ($user['email'] !== $value)
                $user['name'] = $value;

            $this->_request['personalizations'][0][$recipient][] = $user;
        endforeach;

    }

    public function send(Email $email)
    {
        if (empty($this->getConfig('api_key'))) {
            throw new InternalErrorException('API KEY is not specified.');
        }
        if (empty($email->getTo()) && empty($email->getCc()) && empty($email->getBcc())) {
            throw new InternalErrorException('You need specify one destination on to, cc or bcc.');
        }

        #Limits https://sendgrid.com/docs/API_Reference/Web_API_v3/Mail/index.html#-Limitations
        if (count($email->getTo() + $email->getCc() + $email->getBcc()) > 1000) {
            throw new InternalErrorException('You have more than 1000 recipients');
        }

        $http = new Client([
            'host' => $this->getConfig('host'),
            'scheme' => $this->getConfig('scheme'),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getConfig('api_key'),
                'User-Agent' => $this->getConfig('user_agent')
            ]
        ]);
        #pr($email);

        $this->_request['personalizations'][0]['subject'] = $email->getSubject();

        $this->addFrom($email->getFrom());
        $this->addRecipients('to', $email->getTo());
        $this->addRecipients('cc', $email->getCc());
        $this->addRecipients('bcc', $email->getBcc());
        $this->addContents($email);

        pr($this->_request);
        $response = $http->post('/v3/mail/send', json_encode($this->_request), ['type' => 'json']);
        #if (!$response || $response->code >= 400) {
        #    throw new InternalErrorException($response->code);
        #}
        dd($response->json);

        return $response->code === 202 ? $email->getMessageId : false;
    }
}
