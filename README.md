## Laravel Text Messages
Laravel Package To Send Text Messages To Major Phone Providers For Free

### Installation
1. `composer require clean-code-studio/laravel-text-messages`
2. `php artisan vendor:publish`
3. `choose to publish this package`
4. `php artisan migrate`
5. `use CleanCodeStudio\LaravelTextMessages\Textable Trait on any model you want to text`


*Using Textable trait on User Model* 

```
use CleanCodeStudio\LaravelTextMessages\Textable;

class User extends Authenticatable
{
    use Textable;
   
    //...    
```

#####Example Usage: 
```

$user = App\User::create(['email' => 'test@example.com', 'password' => 'secret', 'name' => 'johnDoe']);

// register phone number to user
$user->isTextableVia('Sprint')->at('5555555555');

// then send a text message to the user
$user->text()->message('hello world'); 

```

##### Customization
Set sender address of text message : 
1. Go to `config/textable.php`
2. Set the `from` property 
*Example: *
`config/textable.php`
```
<?php 

return [
  //define who the text message sender address is
  'from' => 'text.from@your.app',
 ];
 ```


##### Supported Cell Phone Providers
All Options Defined In: `config/gateway.php`

```
'options' => [
    'AT&T', 
    'Sprint', 
    'Cricket', 
    'Verizon', 
    'T-Mobile', 
    'US Cellular', 
    'Boost Mobile', 
    'Virgin Mobile'
];
```

##### Supported Gateways

`pms`
`sms`

##### Sending Custom Text Messages With Laravel Mailable Objects
```

$user = App\User::create(['email' => 'test@example.com', 'password' => 'secret', 'name' => 'johnDoe']);

// register phone number to user
$user->isTextableVia('Virgin Mobile')->at('5555555555');

// Send a message with a custom mailable instance
$user->text()->message(new MailableInstance($info)); 

```
   
 
