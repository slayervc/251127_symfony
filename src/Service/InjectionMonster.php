<?php

declare(strict_types=1);

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Service\Attribute\Required;

class InjectionMonster
{
    public EventDispatcherInterface $eventDispatcher;

    private CacheItemPoolInterface $cache;

    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    #[Required]
    public function setCache(CacheItemPoolInterface $cache): void
    {
        $this->cache = $cache;
    }
}
