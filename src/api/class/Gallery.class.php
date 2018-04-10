<?php
class Gallery {

    const MONTHS = ['январь', 'февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь'];

    protected $path_gallery;
    private $data = [];
    private $futureYears = false;
    private $absolute_path

    public function getPath() {
        return substr($this->path_gallery, strlen($_SERVER['DOCUMENT_ROOT']) + 1);
    }
    public function setPathGalery(String $path) {
        if (is_string($path)) {
            $this->checkPathGalery($path);
            $this->path_gallery = $path;
        }
        else {
            throw new GalleryException('не валидный путь до папки ');
        }
    }

    private function checkPathGalery (String $path) {
        if (file_exists($path)) {
            return true;
        }
        throw new GalleryException('папки  не существует');
    }

    private function getNameMonth (String $name) {
        if (is_numeric($name)) {
            $int = intval($name);
            if ($int >= 1 and $int <= 12) {
                return self::MONTHS[$int -1];
            }
            else {
                throw new GalleryException('название месяца не сответствует формату int (1-12)');
            }
        }
        else {
            throw new GalleryException('название месяца не числовое');
        }
    }

    private function buildData (): void {
        $path_years = scandir($this->path_gallery);

        $path_years = array_slice($path_years,2);

        if (empty($path_years)) {
            throw new GalleryException('нет папки с годом');
        }
        arsort($path_years);
        foreach ($path_years as $year) {
            if (!is_dir($this->path_gallery . '/' . $year)) {
                continue;
            }
            $months = scandir($this->path_gallery . '/' . $year);
            $months = array_slice($months,2);
            arsort($months);
            if (empty($months)) {
                unset($this->data[$year]);
            }
            else {
                if ($year > date('Y',time()) ) {
                    continue;
                }
                foreach ($months as $month) {
                    $files = scandir($this->path_gallery . '/' . $year .'/'. $month);
                    $files = array_slice($files, 2);
                    if (empty($files)) {
                        unset($this->data[$year][$month]);
                    }
                    else {
                        if ($month <= date('m',time()) or $year != date('Y',time()) ) {
                            $path = sprintf('%s/%s/%s/',$this->getPath(),$year,$month);
                            $this->data[$year][$this->getNameMonth($month)] = [];
                            foreach ($files as $file) {
                                if (false !== strpos($file,'main')) {
                                    $this->data[$year][$this->getNameMonth($month)]['main'] = $path . $file;
                                }
                                else {
                                    array_push($this->data[$year][$this->getNameMonth($month)], $path . $file) ;
                                }
                            }
                        }
                    }
                }
            }
        }
        if (empty($this->data)) {
            throw new GalleryException('нет файлов для галереи');
        }
    }

    public function getPathGalery() {
        return $this->path_gallery;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = is_array($data) ? $data : [];
    }

    public function __construct (String $path_gallery) {
        try {
            $this->setPathGalery($path_gallery);
            $this->buildData();
            $this->getPath();
        }
        catch (GalleryException $e) {
            return $e->getMessage();
        }
    }
}