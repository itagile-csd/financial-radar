
## Use cases for tooling

### Dev

after pull
* Composer dependencies unchanged: `make serve_dev`
* Composer dependencies changed: `make install_dependencies serve_dev`
* test httpPrompt `make open`

before commit
* `make test_quick`
* changes to base configuration: bump version number in Makefile & server/Dockerfile

after pushing to VCS
* code or dependency changes: `make build_prod push_images`
* changes to base configuration: `make build_base push_images`


### Prod

* run latest prod version: `make serve_most_recent_prod`

## VCS Conventions

* pull with rebase: `git pull --rebase`

### Commit prefixes

. user value (fictitious fradar users)  
& tooling value  
~ refactoring


## References

Which facilities are available in acceptance tests?
https://github.com/laravel/lumen-framework/blob/5.4/src/Testing/Concerns/MakesHttpRequests.php

Logs are under `server/storage/logs`.

The data is persisted to `server/storage/app/assetFlows.json`.

