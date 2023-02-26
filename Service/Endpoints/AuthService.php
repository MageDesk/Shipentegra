<?php
/*
 * @author MageDesk Team
 * @copyright Copyright (c) MageDesk (https://www.magedesk.com/)
 */
declare(strict_types=1);

namespace MageDesk\ShipEntegra\Service\Endpoints;

class AuthService extends AbstractService
{

    /**
     * @var string
     */
    protected string $url = 'auth/token';

    /**
     * @var string
     */
    public const CLIENT_ID = 'clientId';
    public const CLIENT_SECRET = 'clientSecret';

    /**
     * @param string $clientId
     * @return $this
     */
    public function setClientId(string $clientId): AuthService
    {
        $this->setBodyParam(self::CLIENT_ID, $clientId);

        return $this;
    }

    /**
     * @param string $clientSecret
     * @return $this
     */
    public function setClientSecret(string $clientSecret): AuthService
    {
        $this->setBodyParam(self::CLIENT_SECRET, $clientSecret);

        return $this;
    }
}
