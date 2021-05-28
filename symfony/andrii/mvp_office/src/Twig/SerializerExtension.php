<?php


namespace MVP_Office\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerExtension extends AbstractExtension
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getFilters(): array
    {
        return [new TwigFilter('jsonld', [$this, 'serializeToJsonLd'], ['is_safe' => ['html']]),];
    }

    public function serializeToJsonLd($data): string
    {
        return $this->serializer->serialize($data, 'jsonld');
    }
}
