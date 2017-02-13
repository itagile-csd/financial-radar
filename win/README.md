
## Set up Windows machine for dev

* install Docker Toolbox 1.12: https://github.com/docker/toolbox/releases/tag/v1.12.6
  * during installation select "Install Git"
* start Docker Quickstart Terminal, it will still need to setup things
* stay in the Docker Quickstart Terminal, clone this repo
* in an elevated cmd:
```
cd <clone_dir>/win
install_choco_in_elevated_cmd
install_in_elevated_cmd
```

`install_in_elevated_cmd` can be rerun as often as one wishes

* in a non-elevated cmd (still in `<clone_dir>>/win`):
```
make
```

finish by configuring apps
* make Chrome the default browser (Edge did not want to show Json)
* set up SourceTree
* create Docker link for Cmder
* try Getting Started


## Explanations for setup choices

Setup was done with old Dell Vostros with only 4GB RAM and with Win 10

Docker for Windows, which uses Hyper-V, did not work. Docker Service complained about too little RAM during startup.

Did not try Docker Toolbox with Hyper-V. Docker Toolbox with VirtualBox is convenient enought. It already installs Git, VirtualBox and configures everything.

Used Docker Toolbox v1.12.6 instead of the more recent 1.13.1a because 1.13. produced annoying warning "unable to use system certrificate pool" on every `docker` call, cp. https://github.com/docker/docker/issues/30450.

