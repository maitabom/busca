<?php

/**
 * Class Search
 */
class Search
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param Integer $codigo
     * @return array
     */
    public function item($codigo)
    {
        $matches = array();
        preg_match("/^{$codigo};.*/im", $this->content, $matches);
        return empty($matches) ? array() : array($this->hydrate($matches[0]));
    }

    /**
     * @param array $codigos
     * @return array
     */
    public function items($codigos)
    {
        $result = array();
        
        foreach($codigos as $codigo)
        {
            $match = $this->item($codigo);

            if(!empty($match))
            {
                $result[] = $match[0];
            }
        }

        return $result;
    }

    /**
     * Search constructor.
     * @param String $database
     */
    public function __construct($database)
    {
        $this->content = file_get_contents($database);
    }

    private function hydrate($line)
    {
        $data = explode(";", $line);

        $item = new stdClass();
        $item->codigo = $data[0];
        $item->nome = $data[1];
        $item->medida = $data[2];
        $item->preco = $data[3];
        $item->fabricante = $data[4];

        return $item;
    }
}