# Change Log

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## Unreleased

_..._

## 2.0.1 - 2016-08-29
### Fixed
- `OptionsRequiredTrait` to send the correct missing fields when throwing an exception

## 2.0.0 - 2016-08-26
### Added

- `CommandImmutableOptionsTrait` for copying commands when setting options
- `OptionsInterface` for implementation of options as values objects
- `OptionsHydrateTrait` for hydrating option properties
- `OptionsSerializerTrait` for JSON serializing support for options
- `OptionsRequiredTrait` for checking required values for options

### Changed

- `CommandInterface` was simplified for usage with option value objects

### Removed

- `Command` and `Options` were deemed to be a bad implementation of value objects
- `ImmutableException` was only used by `Options`
- `CommandException::needsOptions()` was only used by `Command`

### Deprecated

- `AbstractCommand` will be removed in 3.0.0

## 1.3.0 - 2016-06-04

- Added `Command` and `Options` abstract classes
- Deprecated `AbstractCommand` and `CommandInterface`

## 1.2.0 - 2016-03-22

- Added `getHttpStatus` to command exception
- Report all missing options at once with command exception
- Deprecated `CommandException::missingOption` in favor of `missingOptions`

## 1.1.0 - 2016-03-14

- Added `defaultOptions` to the command interface and abstract

## 1.0.0 - 2016-01-05

- Initial release
- Changed from `Spark` to `Equip` namespace
