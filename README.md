
## Use cases for tooling

### Dev

after pull
* Composer dependencies unchanged: `make serve_dev`
* Composer dependencies changed: `make install_dependencies serve_dev`

before commit
* `make before_commit`
* changes to base configuration: bump version number in Makefile

after pushing to VCS
* code or dependency changes: `make build_prod push_images`
* changes to base configuration: `make build_base push_images`


### Prod

* run latest prod version: `make serve_most_recent_prod`


## Commit prefixes

. user value (fictitious fradar users)  
& tooling value  
~ refactoring

