<?php

declare(strict_types=1);

namespace ModularityTimeline;

use ComponentLibrary\Integrations\Image\Image as ImageComponentContract;
use Modularity\Integrations\Component\ImageResolver;

class Timeline extends \Modularity\Module
{
    public $slug = 'timeline';
    public $icon = 'background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMTAwIj48cGF0aCBkPSJNMTQuNTI5LDE3Ljk3YzAtMi41NzEtMS42NDctNC43NTctMy45NDEtNS41NjlWOC4xMTcgICAgYzAtMS4wODktMC44ODMtMS45NzEtMS45Ny0xLjk3MWMtMS4wODcsMC0xLjk3MSwwLjg4MS0xLjk3MSwxLjk3MXY0LjI4NGMtMi4yOTQsMC44MTItMy45NDEsMi45OTgtMy45NDEsNS41NjkgICAgYzAsMi41NzEsMS42NDcsNC43NTcsMy45NDEsNS41Njl2MjAuMzkyYy0yLjI5NCwwLjgxMi0zLjk0MSwyLjk5OC0zLjk0MSw1LjU2OXMxLjY0Nyw0Ljc1NywzLjk0MSw1LjU2OXYyMC4zOTIgICAgYy0yLjI5NCwwLjgxMi0zLjk0MSwyLjk5OC0zLjk0MSw1LjU2OXMxLjY0Nyw0Ljc1NywzLjk0MSw1LjU2OXY0LjI4M2MwLDEuMDksMC44ODMsMS45NzEsMS45NzEsMS45NzEgICAgYzEuMDg3LDAsMS45Ny0wLjg4MSwxLjk3LTEuOTcxVjg2LjZjMi4yOTQtMC44MTIsMy45NDEtMi45OTgsMy45NDEtNS41NjlzLTEuNjQ3LTQuNzU4LTMuOTQxLTUuNTY5VjU1LjA2OSAgICBjMi4yOTQtMC44MTIsMy45NDEtMi45OTgsMy45NDEtNS41NjlzLTEuNjQ3LTQuNzU3LTMuOTQxLTUuNTY5VjIzLjUzOUMxMi44ODEsMjIuNzI4LDE0LjUyOSwyMC41NDEsMTQuNTI5LDE3Ljk3eiBNOTMuMzU0LDEwLjA4NyAgICBIMzYuMjA2YzAsMC0yLjY0LTAuMjM1LTMuNDQ5LDAuNTdMMjQuOTQsMTYuNDhjLTAuODA4LDAuODA1LTAuODA4LDIuMTA5LDAsMi45MTRsNy44MTcsNS44MjMgICAgYzAuODA5LDAuODA1LDMuNDQ5LDAuNjM1LDMuNDQ5LDAuNjM1aDU3LjE0OGMyLjE3OSwwLDMuOTQxLTEuNzYzLDMuOTQxLTMuOTQxdi03Ljg4MkM5Ny4yOTUsMTEuODUxLDk1LjUzMiwxMC4wODcsOTMuMzU0LDEwLjA4N3ogICAgIE05My4zNTQsNDEuNjE4SDM2LjIwNmMwLDAtMi42NC0wLjIzNS0zLjQ0OSwwLjU2OWwtNy44MTcsNS44MjRjLTAuODA4LDAuODA0LTAuODA4LDIuMTA5LDAsMi45MTNsNy44MTcsNS44MjMgICAgYzAuODA5LDAuODA1LDMuNDQ5LDAuNjM2LDMuNDQ5LDAuNjM2aDU3LjE0OGMyLjE3OSwwLDMuOTQxLTEuNzYzLDMuOTQxLTMuOTQxdi03Ljg4M0M5Ny4yOTUsNDMuMzgsOTUuNTMyLDQxLjYxOCw5My4zNTQsNDEuNjE4eiAgICAgTTkzLjM1NCw3My4xNDdIMzYuMjA2YzAsMC0yLjY0LTAuMjM0LTMuNDQ5LDAuNTY5TDI0Ljk0LDc5LjU0Yy0wLjgwOCwwLjgwNS0wLjgwOCwyLjEwOSwwLDIuOTE0bDcuODE3LDUuODIzICAgIGMwLjgwOSwwLjgwNSwzLjQ0OSwwLjYzNSwzLjQ0OSwwLjYzNWg1Ny4xNDhjMi4xNzksMCwzLjk0MS0xLjc2MywzLjk0MS0zLjk0MXYtNy44ODJDOTcuMjk1LDc0LjkxLDk1LjUzMiw3My4xNDcsOTMuMzU0LDczLjE0N3oiLz48L3N2Zz4=';
    public $supports = [];

    public function init()
    {
        $this->nameSingular = __('Timeline', 'modularity-timeline');
        $this->namePlural = __('Timelines', 'modularity-timeline');
        $this->description = __('Display a timeline', 'modularity-timeline');
    }

    public function data(): array
    {
        $fields = $this->getFields();

        $data = [];
        $data['classes'] = implode(' ', apply_filters('Modularity/Module/Classes', [], $this->post_type, $this->args));
        $data['attributes'] = implode(' ', apply_filters('Modularity/Module/Attributes', [], $this->post_type, $this->args));

        $events = isset($fields['timeline_events']) && is_array($fields['timeline_events']) ? $fields['timeline_events'] : [];

        foreach ($events as &$event) {
            $event['image_grid'] = 'grid-md-12';
            $event['content_grid'] = 'grid-md-12';
            $event['format'] = get_field('timeline_format', $this->ID);
            $eventTimeDate = $event['format'] ? substr($event['timestamp'], 0, -3) : $event['date'];
            $event['timelineDate'] = $this->timelineDate($this->ID, $eventTimeDate);
            if (!empty($event['image']) && isset($event['image']['ID'])) {
                $event['imageSrc'] = ImageComponentContract::factory(
                    $event['image']['ID'],
                    [1024, false],
                    new ImageResolver(),
                );
            }
        }

        $data['events'] = $events;
        $data['sequential'] = isset($fields['timeline_sequential_mode']) ? $fields['timeline_sequential_mode'] : false;
        return $data;
    }

    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return 'timeline.blade.php';
    }

    /**
     * Return formatted date within span
     * @param  int    $id   Module ID
     * @param  string $date Timeline event date
     * @return string
     */
    public function timelineDate($id, $date): string
    {
        if (!get_field('timeline_format', $id)) {
            $format = get_field('timeline_date_format', $id);
            switch ($format) {
                case 'dm':
                    $date = '<span>' . mysql2date('d M', $date, true) . '</span>';
                    break;
                case 'y':
                    $date = '<span>' . mysql2date('Y', $date, true) . '</span>';
                    break;
                default:
                    $date = '<span>' . mysql2date('d M', $date, true) . '</span> ' . '<span>' . mysql2date('Y', $date, true) . '</span>';
                    break;
            }
            return $date;
        } else {
            return '<span>' . $date . '</span>';
        }
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization (if you must, use __construct with care, this will probably break stuff!!)
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
