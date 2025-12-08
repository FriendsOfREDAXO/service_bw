# Service BW

Dieses AddOn ist ein API Client für die [Service BW](https://www.service-bw.de/) API. (Baden-Württemberg)

Eine Dokumentation der Schnittstelle gibt es hier

https://sgw.service-bw.de/rest-v2/documentation/#/Portal%3A%20Lebenslagen

## Installation

1. Installieren Sie das AddOn über den Redaxo Installer.
2. Konfigurieren Sie das AddOn unter "Einstellungen" im Redaxo Backend.
3. Verwenden Sie die bereitgestellten Funktionen, um auf die Service BW API zuzugreifen.

## Erstellung des Bearer Tokens

Um einen Bearer Token zu erstellen, müssen Sie den folgenden Schritt ausführen:

```
curl --location 'https://sgw.service-bw.de/wsbenutzer/token?scope=read&benutzername=<BENUTZERNAME>' \
--header 'X-SP-Mandant: <MANDANTENNUMMER>' \
--header 'Content-Type: text/plain' \
--header 'Accept: text/plain' \
--data '<PASSWORT>'
```

## Einbindung in Redaxo

Ein Modul erstellen und in der Ausgabe den folgenden Code verwenden:

```php
echo \FriendsOfRedaxo\ServiceBw\View::getLebenslagen();

```

```php
echo \FriendsOfRedaxo\ServiceBw\View::getDienstleistungen();

```

Alternative Schreibweise:

```php
use FriendsOfRedaxo\ServiceBw\View;

echo View::getLebenslagen();

```

```php
use FriendsOfRedaxo\ServiceBw\View;

echo View::getDienstleistungen();

```


