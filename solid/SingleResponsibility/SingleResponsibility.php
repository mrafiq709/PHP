<?php

class Json
{
    public static function from($data)
    {
        return json_encode($data);
    }
}

class UserRequest
{
    protected static $rules = [
        'name' => 'string',
        'email' => 'string'
    ];

    public static function validate($data)
    {
        foreach ($data as $property => $type) {
            if (gettype($data[$property]) !== $type) {
                throw new \Exception("User property {$property} must be Of type {$type}");
            }
        }
    }
}

class User
{
    public $name;
    public $email;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    // public function formatJson()
    // {
    //     return json_encode(['name' => $this->name, 'email' => $this->email]);
    // }

    // public function validate($data)
    // {
    //     if (!isset($data['name'])) {
    //         throw new \Exception("Bad Request, User requires a name");
    //     }

    //     if (!isset($data['email'])) {
    //         throw new \Exception("Bad Request, User requires a email");
    //     }
    // }
}

Route::get('/', function () {
    $data = [
        'name' => 'Demo',
        'email' => 'dem@gmail.com'
    ];

    UserRequest::validate($data);

    $user = new User($data);

    return Json::from($user);
});
