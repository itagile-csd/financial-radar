
## Use cases for tooling

### Dev

after pull
* Composer dependencies unchanged: `make serve_dev`
* Composer dependencies changed: `make install_dependencies serve_dev`

before commit
* `make test`
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

https://github.com/laravel/lumen-framework/blob/5.4/src/Testing/Concerns/MakesHttpRequests.php


## Set up Windows machine for dev

* install Docker Toolbox https://github.com/docker/toolbox/releases/tag/v1.12.6
* clone repo
* in an elevated cmd:
```
cd <clone_dir>/win
install_choco_in_elevated_cmd
install_in_elevated_cmd
```

`install_in_elevated_cmd` can be rerun as often as one wishes

