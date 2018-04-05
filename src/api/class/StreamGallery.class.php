<?php

class StreamGallery extends Gallery {

    private $streams = [];

    const CONFIG_NAME = 'config.yaml';

    public function __construct ($path){
        parent::__construct($path);
        try {
            $config = Symfony\Component\Yaml\Yaml::parseFile($this->path_gallery . '/'. self::CONFIG_NAME);
            $this->streams = $config['stream'];
        } catch (ParseException $exception) {
            return $exception->getMessage();
        }
    }

    public function getStream() {
        return $this->streams;
    }

    public function setStream($link) {
        array_push($this->streams, $link);
    }
}