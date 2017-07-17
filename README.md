dockit
======

dockit is an opinionated configuration management/workflow tool for docker.

It works like this:

1. You configure or download one or more 'apps'. A dockit app is a `docker-compose.yml` file (with all of its dependencies), with its configuration nicely abstracted into environment variables.
2. You define one or more 'deployments' of these apps (a deployment defines which apps are installed on which hosts, with it's own configuration)
3. You run `dockit deployment:up`

Dockit will:

1. Create a remote directory for each deployment on the specified host
2. Copy all of the app's dependencies (config files, etc) into the remote app path (replacing variables where applicable)
3. Generate a `.env` file based on the deployment configuration
4. (optionally) create an nginx vhost
5. run `docker-compose up` on the new deployment

## Configuration

Copy the provided `.env.dist` to `.env` and change the parameters to your preferences.

Dockit will try to read `.env` from the local directory, or otherwise from `~/.dockit`

## Usage:

Run `dockit show` to show the current configuration, and list all apps and deployments at your disposal.

## Diffs

Before running a new `deployment:install`, you can check the differences that are going to be applied
using the `deployment:diff` command.
This command uses the `colordiff` CLI command, which needs to be installed through your package manager (i.e. `brew install colordiff`, `apt-get install colordiff`, etc)

## Variables and template files

When dockit copies the local files over to the remote host with `dockit deployment:install`,
variables in those files are automatically replaced with their deployment-specific values.

The format of the values are the same as used in the `docker-compose.yml` files:

    ${THIS_IS_A_VARIABLE}

Using the `dockit deployment:diff` command will pre-apply the variables before comparing the local and remote files, so the local variables don't show up as diffs against the remote replaced variable values.

## Examples

* For example apps, please check `example/apps`
* For example deployments, please check `example/deployments`

## License

MIT. Please refer to the [license file](LICENSE) for details.

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
