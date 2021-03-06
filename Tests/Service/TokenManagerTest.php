<?php declare(strict_types=1);

namespace Tests\Service;

use Wolnosciowiec\FileRepositoryBundle\Exception\FileRepositoryRequestFailureException;
use Wolnosciowiec\FileRepositoryBundle\Service\TokenManager;
use Wolnosciowiec\FileRepositoryBundle\Tests\ContainerAwareTestCase;

/**
 * @package Tests\Service
 */
class TokenManagerTest extends ContainerAwareTestCase
{
    /**
     * @throws FileRepositoryRequestFailureException
     */
    public function testRequestTemporaryToken()
    {
        $token = $this->container->get(TokenManager::class)->requestTemporaryToken(
            ['test_role1'],
            ['uploads']
        );

        $this->assertInternalType('string', $token);
        $this->assertSame(36, strlen($token));
    }
}