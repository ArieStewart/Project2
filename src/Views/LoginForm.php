<?php

namespace Views;


class LoginForm extends View
{
    public function __construct()
    {
        $this->content = <<<LOGIN_FORM

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login Form</title>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css">
    </head>
    <body>
        <h1>Welcome</h1>

        <div align="center">
            <form method="POST" action="/auth">
                Username: <input type="text" name="username" size="15" /><br />
                Password: <input type="password" name="password" size="15" /><br />
                <br />
                Select Auth Type:
                <input type = "radio" name = "authType" value = "File"> File
                <input type = "radio" name = "authType" value = "InMemory"> In Memory
                <input type = "radio" name = "authType" value = "MySQL"> MySQL
                <p><input type="submit" value="Login" /></p>
            </form>
        </div>
    </body>
</html>
LOGIN_FORM;
    }
}
