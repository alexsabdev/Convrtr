# convrtr
CLI application for converting different file formats (CSV, JSON, XML, etc.).

## Features
* Convert from JSON to CSV
* Convert from CSV to JSON
* More file types coming...

## Requirements
* PHP 5.4+
* Composer

## Usage

* Clone the package and install dependencies
```bash
$ cd ~
$ git clone https://github.com/alexsabdev/convrtr.git
$ cd convrtr
$ composer install
```
* Add the directory to your PATH environment variable
```bash
$ export PATH=$PATH:~/convrtr
```
* Get a list of available commands
```bash
$ convrt
```
* See the magic!
```bash
$ convrt json2csv src.json dest.csv
```

## License

This is an open-sourced software licensed under the [MIT license](https://github.com/alexsabdev/convrtr/blob/master/LICENSE).