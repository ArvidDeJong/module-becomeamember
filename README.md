# Module Become a Member

Een Manta CMS module voor Laravel om een "Word lid" formulier toe te voegen aan je website.

## Vereisten

- PHP ^8.3
- Laravel ^11.0
- Livewire ^3.0
- Livewire Flux ^2.0
- Darvis Manta ^1.0

## Installatie

1. Voeg de repository toe aan je `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/darvis-nl/module-becomeamember"
        }
    ]
}
```

2. Installeer het package via Composer:

```bash
composer require darvis/module-becomeamember
```

De service provider wordt automatisch geregistreerd via Laravel's package discovery.

## Configuratie

Publiceer de configuratie bestanden:

```bash
php artisan vendor:publish --tag=becomeamember-config
```

### E-mail Configuratie

De module gebruikt de volgende e-mail instellingen die je kunt configureren in je `.env` bestand:

```env
MAIL_TO_ADDRESS=your@email.com
```

Je kunt ook meerdere ontvangers configureren via de Manta CMS instellingen onder `BECOMEAMEMBER_RECEIVERS`. Dit is een JSON array met e-mailadressen. Gebruik `##ZENDER##` om ook een kopie naar de aanmelder te sturen.

## Componenten

De module bevat de volgende Livewire componenten:

- `becomeamember-list` - Overzicht van alle aanmeldingen
- `becomeamember-create` - Formulier voor nieuwe aanmeldingen
- `becomeamember-update` - Bewerk formulier voor bestaande aanmeldingen
- `becomeamember-read` - Detail weergave van een aanmelding
- `becomeamember-settings` - Beheer instellingen voor de module
- `becomeamember-button-email` - E-mail knop component voor het versturen van bevestigingen

## Views

De views kunnen worden aangepast door ze te publiceren:

```bash
php artisan vendor:publish --tag=becomeamember-views
```

## Vertalingen

Publiceer de vertalingen om ze aan te passen:

```bash
php artisan vendor:publish --tag=becomeamember-lang
```

## Database

De module installeert automatisch de benodigde database tabellen via migrations. Deze worden uitgevoerd tijdens de installatie.

## Gebruik

### Formulier Toevoegen

Voeg het aanmeldformulier toe aan je Blade template:

```blade
<livewire:becomeamember-create />
```

### Beheer Overzicht

Het beheer overzicht is beschikbaar via de Manta CMS admin interface:

```blade
<livewire:becomeamember-list />
```

## Credits

Ontwikkeld door [Darvis](https://www.arvid.nl)

## Licentie

MIT License
