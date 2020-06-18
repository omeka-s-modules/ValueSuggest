<?php
namespace ValueSuggest\Service;

use Interop\Container\ContainerInterface;
use ValueSuggest\DataType\Tesauros\Tesauros;
use Laminas\ServiceManager\Factory\FactoryInterface;

class TesaurosDataTypeFactory implements FactoryInterface
{
    protected $types = [
        'valuesuggest:tesauros:bienesculturales' => [
            'label' => 'Tesauros: Diccionario de Bienes Culturales', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/bienesculturales',
        ],
        'valuesuggest:tesauros:materias' => [
            'label' => 'Tesauros: Diccionario de Materias', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/materias',
        ],
        'valuesuggest:tesauros:tecnicas' => [
            'label' => 'Tesauros: Diccionario de Técnicas', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/tecnicas',
        ],
        'valuesuggest:tesauros:contextosculturales' => [
            'label' => 'Tesauros: Diccionario de Contextos Culturales', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/contextosculturales',
        ],
        'valuesuggest:tesauros:geografico' => [
            'label' => 'Tesauros: Diccionario Geográfico', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/geografico',
        ],
        'valuesuggest:tesauros:toponimiahistorica' => [
            'label' => 'Tesauros: Diccionario de Toponimia Histórica', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/toponimiahistorica',
        ],
        'valuesuggest:tesauros:ceramica' => [
            'label' => 'Tesauros: Diccionario de Cerámica', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/ceramica',
        ],
        'valuesuggest:tesauros:numismatica' => [
            'label' => 'Tesauros: Diccionario de Numismática', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/numismatica',
        ],
        'valuesuggest:tesauros:mobiliario' => [
            'label' => 'Tesauros: Diccionario de Mobiliario', // @translate
            'scheme' => 'http://tesauros.mecd.es/tesauros/mobiliario',
        ],
    ];

    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        $dataType = new Tesauros($services);
        $dataType->setTesaurosName($requestedName);
        $dataType->setTesaurosLabel($this->types[$requestedName]['label']);
        $dataType->setTesaurosScheme($this->types[$requestedName]['scheme']);
        return $dataType;
    }
}
