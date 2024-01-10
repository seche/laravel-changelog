<?php

namespace Seche\LaravelChangelog;

use Seche\LaravelChangelog\Models\Changelog;

class Version
{
    private $changelog;

    public function __construct(Changelog $changelog = null)
    {
        if(!empty($changelog) && get_class($changelog) === 'Changelog') $this->changelog = $changelog;
        else $this->changelog = Changelog::orderBy('major', 'DESC')->orderBy('minor', 'DESC')->orderBy('patch', 'DESC')->first();
    }

    public function getFullVersion(): string
    {
        $version = __('changelog::app.version_full') . $this->getVersion();

        $version .= !empty($this->changelog->prerelease) ? '-' . $this->changelog->prerelease : '';
        $version .= !empty($this->changelog->build) ? '+' . $this->changelog->build : '';
        $version .= !empty($this->changelog->commit) ? ' (commit ' . $this->changelog->commit . ')' : '';

        return $version;
    }

    public function getCompactVersion(): string
    {
        $version = __('changelog::app.version_compact') . $this->getVersion();

        $version .= !empty($this->changelog->commit) ? ' (commit ' . $this->changelog->commit . ')' : '';

        return $version;
    }

    public function getVersion(): string
    {
        if(empty($this->changelog)) return '0.0.0';
        return $this->changelog->major . '.' . $this->changelog->minor . '.' . $this->changelog->patch;
    }

    public function getLatestChangelog()
    {
        return $this->changelog;
    }

    public function setChangelog(Changelog $changelog): Version
    {
        $this->changelog = $changelog;

        return $this;
    }

    public function get($id): Version
    {
        $this->changelog = Changelog::where('id', $id)->first();

        return $this;
    }

}
