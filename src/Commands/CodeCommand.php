<?php

/**
 * This command will clone the code from any available Pantheon site environment to your local system.
 *
 * See README.md for usage information.
 */

namespace TerminusPluginProject\TerminusCode\Commands;

use Pantheon\Terminus\Commands\Site\SiteCommand;
use Pantheon\Terminus\Exceptions\TerminusNotFoundException;

class CodeCommand extends SiteCommand
{
    /**
     * Clones the code from any available site environment.
     *
     * @authorize
     *
     * @command site:env:code
     * @aliases env:code code
     *
     * @usage terminus site:env:code | env:code | code <site>.<env>
     *     Clone the code of <site>.<env> locally. Example: terminus code my-site.dev.
     */
    public function code($site_env = false)
    {

        if (!$site_env) {
            throw new TerminusNotFoundException('Usage: terminus site:env:code | env:code | code <site>.<env>');
        }

        $this->sites()->fetch(
            [
                'org_id' => null,
                'team_only' => false,
            ]
        );

        $sites = $this->sites->serialize();

        if (empty($sites)) {
            throw new TerminusNotFoundException('You have no sites.');
        }

        // Validate if site.env exists.
        $site_env_exists = false;
        $site_env_frozen = false;
        foreach ($sites as $site) {
            if ($environments = $this->getSite($site['name'])->getEnvironments()->serialize()) {
                foreach ($environments as $environment) {
                    if ($environment['initialized'] == 'true') {
                        $site_environment = $site['name'] . '.' . $environment['id'];
                        if ($site_env == $site_environment) {
                            $site_env_exists = true;
                            $site_env_frozen = ($site['frozen'] == 'true');
                            break;
                        }
                    }
                }
            }
            if ($site_env_exists) {
                break;
            }
        }

        if (!$site_env_exists) {
            $message = 'Site environment {site_env} does not exist.';
            throw new TerminusNotFoundException($message, ['site_env' => $site_env]);
        }

        if ($site_env_frozen) {
            $message = 'Site environment {site_env} is frozen.';
            throw new TerminusNotFoundException($message, ['site_env' => $site_env]);
        }

        $command = '$(terminus connection:info ' . $site_env . ' --field=git_command)';
        $this->execute($command);
    }

    /**
     * Executes the command.
     */
    protected function execute($cmd)
    {
        $process = proc_open(
            $cmd,
            [
                0 => STDIN,
                1 => STDOUT,
                2 => STDERR,
            ],
            $pipes
        );
        proc_close($process);
    }
}
