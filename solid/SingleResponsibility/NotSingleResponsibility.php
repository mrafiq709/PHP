<?php

class User
{
    public $name;
    public $email;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }

    public function formatJson()
    {
        return json_encode(['name' => $this->name, 'email' => $this->email]);
    }

    public function validate($data)
    {
        if (!isset($data['name'])) {
            throw new \Exception("Bad Request, User requires a name");
        }

        if (!isset($data['email'])) {
            throw new \Exception("Bad Request, User requires a email");
        }
    }
}

Route::get('/', function () {
    $data = [
        'name' => 'Demo',
        'email' => 'dem@gmail.com'
    ];

    $user = new User($data);
    $user->validate($data);
    return $user->formatJson();
});
