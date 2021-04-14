# imail.ma for PHP

 Librairie pour l'envoie d'e-mails via imail.ma en PHP 5.4 et plus. 
 
## Installation

Installer la librairie en utilisant [Composer](https://getcomposer.org/):

```
$ composer require imail/imail
```

## Usage

L'envoi d'un e-mail est très simple. Suivez simplement l'exemple ci-dessous. Avant de pouvoir commencer, vous
vous devez vous connecter à notre interface Web et générer un nouvel identifiant API.

```php
// Créez un nouveau client imail à l'aide de la clé de serveur que vous générez dans l'interface Web 
$client = new Imail\Client('https://mx.imail.ma', 'votre-clé-api');

// Créer un nouveau message 
$message = new Imail\SendMessage($client);

// Ajouter quelques destinataires 
$message->to('simo@exemple.com');
$message->to('youssef@exemple.com');
$message->cc('mehdi@exemple.com');
$message->bcc('secret@exemple.com');

// Spécifiez de qui le message doit provenir. Cela doit provenir d'un domaine vérifié 
// sur votre serveur de messagerie.
$message->from('test@domaine.ma');

// Définir le sujet
$message->subject('Salam!');

// Définir le contenu de l'e-mail 
$message->plainBody('Hello world!');
$message->htmlBody('<p>Hello world!</p>');

// Ajouter des en-têtes personnalisés
$message->header('X-PHP-Test', 'valeur');

// Joindre des fichiers 
$message->attach('pj.txt', 'text/plain', 'Hello world!');

// Envoyez le message et obtenez le résultat 
$result = $message->send();

// Parcourez chacun des destinataires pour obtenir l'ID du message 
foreach ($result->recipients() as $email => $message) {
    $email;            // L'adresse e-mail du destinataire 
    $message->id();    // Renvoie l'ID du message 
    $message->token(); // Renvoie le jeton du message 
}
```
