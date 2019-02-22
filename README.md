# Terminus Code Plugin

Version 2.x

[![CircleCI](https://circleci.com/gh/terminus-plugin-project/terminus-code-plugin.svg?style=shield)](https://circleci.com/gh/terminus-plugin-project/terminus-code-plugin)
[![Terminus v2.x Compatible](https://img.shields.io/badge/terminus-v2.x-green.svg)](https://github.com/terminus-plugin-project/terminus-code-plugin/tree/2.x)
[![Terminus v1.x Compatible](https://img.shields.io/badge/terminus-v1.x-green.svg)](https://github.com/terminus-plugin-project/terminus-code-plugin/tree/1.x)
[![Terminus v0.x Compatible](https://img.shields.io/badge/terminus-v0.x-green.svg)](https://github.com/terminus-plugin-project/terminus-code-plugin/tree/0.x)

Terminus plugin to clone the code from any available [Pantheon](https://www.pantheon.io) site environment to your local system.

## Usage:
```
$ terminus site:env:code | env:code | code <site>.<env>
```

## Example:
Clone the code from the my-site development environment.
```
terminus code my-site.dev
```

Learn more about [Terminus](https://pantheon.io/docs/terminus/) and [Terminus Plugins](https://pantheon.io/docs/terminus/plugins/).

## Installation:
For installation help, see [Manage Plugins](https://pantheon.io/docs/terminus/plugins/).

```
mkdir -p ~/.terminus/plugins
composer create-project -d ~/.terminus/plugins terminus-plugin-project/terminus-code-plugin:~2
```

## Configuration:

This plugin requires no configuration to use.

## Testing:
```
export TERMINUS_SITE=my-site
cd ~/.terminus/plugins/terminus-code-plugin
composer install
composer test
```

## Help:
Run `terminus help code` for help.
