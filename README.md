# Whitespace a11ystack for Wordpress

Wordpress plugin that adds a11ystack-specific enhancements and features to Wordpress.

## How to install

If you want to use this plugin as an MU-plugin, first add this to your
composer.json:

```json
{
  "extra": {
    "installer-paths": {
      "path/to/your/mu-plugins/{$name}/": [
        "whitespace-se/wordpress-plugin-a11ystack"
      ]
    }
  }
}
```

Where `path/to/your/mu-plugins` is something like `wp-content/mu-plugins` or
`web/app/mu-plugins`.

Then get the plugin via composer:

```bash
composer require whitespace-se/wordpress-plugin-a11ystack
```

## Contributing

Generate new pot file with this command:

```
wp i18n make-pot . --exclude=vendor,wp-content,node_modules languages/whitespace-a11ystack.pot
```