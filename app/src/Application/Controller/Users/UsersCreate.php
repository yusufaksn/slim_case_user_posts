<?php

namespace App\Application\Controller\Users;

use App\Application\Controller\BaseController;
use App\Application\Traits\FetchService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsersCreate extends BaseController
{
    use FetchService;
    public function __invoke(Request $request, Response $response): Response
    {
        $usersData = $this->getService('https://jsonplaceholder.typicode.com/users');
        if(isset($usersData) and !empty($usersData)){
            foreach ($usersData as $user) {
                $stmt = $this->getContainer->get('db')->prepare("INSERT INTO users 
            (id, name, username, email, street, suite, city, zipcode, lat, lng, phone, website, company_name, company_catchphrase, company_bs)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $user['id']);
                $stmt->bindParam(2, $user['name']);
                $stmt->bindParam(3, $user['username']);
                $stmt->bindParam(4, $user['email']);
                $stmt->bindParam(5, $user['address']['street']);
                $stmt->bindParam(6, $user['address']['suite']);
                $stmt->bindParam(7, $user['address']['city']);
                $stmt->bindParam(8, $user['address']['zipcode']);
                $stmt->bindParam(9, $user['address']['geo']['lat']);
                $stmt->bindParam(10, $user['address']['geo']['lng']);
                $stmt->bindParam(11, $user['phone']);
                $stmt->bindParam(12, $user['website']);
                $stmt->bindParam(13, $user['company']['name']);
                $stmt->bindParam(14, $user['company']['catchPhrase']);
                $stmt->bindParam(15, $user['company']['bs']);
                $stmt->execute();
            }
            $response->getBody()->write('Success');
        }else{
            $response->getBody()->write('Failed');
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

}