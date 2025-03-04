<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\AdminBundle\Event;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * This event is sent by hook:
 *   - preBatchAction.
 *
 * You can register the listener to the event dispatcher by using:
 *   - sonata.admin.event.batch_action.pre_batch_action)
 *
 * @author Jochem Klaver <info@7ochem.nl>
 *
 * @phpstan-template T of object
 */
final class BatchActionEvent extends Event
{
    public const TYPE_PRE_BATCH_ACTION = 'pre_batch_action';

    /**
     * @phpstan-var AdminInterface<T>
     */
    private AdminInterface $admin;

    /**
     * @phpstan-var self::TYPE_*
     */
    private string $type;

    private string $actionName;

    /**
     * @phpstan-var ProxyQueryInterface<T>
     */
    private ProxyQueryInterface $proxyQuery;

    /**
     * @var mixed[]
     */
    private array $idx;

    private bool $allElements;

    /**
     * @param mixed[] $idx
     *
     * @phpstan-param AdminInterface<T> $admin
     * @phpstan-param self::TYPE_* $type
     * @phpstan-param ProxyQueryInterface<T> $proxyQuery
     */
    public function __construct(AdminInterface $admin, string $type, string $actionName, ProxyQueryInterface $proxyQuery, array &$idx, bool $allElements)
    {
        $this->admin = $admin;
        $this->type = $type;
        $this->actionName = $actionName;
        $this->proxyQuery = $proxyQuery;
        $this->idx = &$idx;
        $this->allElements = $allElements;
    }

    /**
     * @phpstan-return AdminInterface<T>
     */
    public function getAdmin(): AdminInterface
    {
        return $this->admin;
    }

    /**
     * @phpstan-return self::TYPE_*
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @return ProxyQueryInterface<T>
     */
    public function getProxyQuery(): ProxyQueryInterface
    {
        return $this->proxyQuery;
    }

    /**
     * @return mixed[]
     */
    public function &getIdx(): array
    {
        return $this->idx;
    }

    public function isAllElements(): bool
    {
        return $this->allElements;
    }
}
