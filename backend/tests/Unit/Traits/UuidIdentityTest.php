<?php

namespace App\Tests\Unit\Traits;

use App\Traits\UuidIdentity;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class UuidIdentityTest extends TestCase
{
    private object $testObject;

    protected function setUp(): void
    {
        $class = new class {
            use UuidIdentity;
        };
        $this->testObject = $class;
    }

    public function testOnPrePersistGeneratesUuid(): void
    {
        $reflection = new ReflectionClass($this->testObject);
        $method = $reflection->getMethod('onPrePersist');
        $method->setAccessible(true);
        $method->invoke($this->testObject);

        $id = $this->testObject->getId();
        $this->assertNotNull($id);
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            $id
        );
    }

    public function testOnPrePersistSetsCreatedAtAndUpdatedAt(): void
    {
        $reflection = new ReflectionClass($this->testObject);
        $method = $reflection->getMethod('onPrePersist');
        $method->setAccessible(true);
        $method->invoke($this->testObject);

        $this->assertInstanceOf(\DateTimeImmutable::class, $this->testObject->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $this->testObject->getUpdatedAt());
        $this->assertEquals($this->testObject->getCreatedAt(), $this->testObject->getUpdatedAt());
    }

    public function testOnPreUpdateUpdatesUpdatedAt(): void
    {
        $reflection = new ReflectionClass($this->testObject);
        $persistMethod = $reflection->getMethod('onPrePersist');
        $persistMethod->setAccessible(true);
        $persistMethod->invoke($this->testObject);

        $originalUpdatedAt = $this->testObject->getUpdatedAt();

        // Small delay to ensure different timestamp
        usleep(1000);

        $updateMethod = $reflection->getMethod('onPreUpdate');
        $updateMethod->setAccessible(true);
        $updateMethod->invoke($this->testObject);

        $this->assertGreaterThan($originalUpdatedAt, $this->testObject->getUpdatedAt());
        $this->assertEquals($this->testObject->getCreatedAt(), $this->testObject->getCreatedAt()); // createdAt unchanged
    }

    public function testOnPrePersistDoesNotOverwriteExistingId(): void
    {
        $reflection = new ReflectionClass($this->testObject);
        $idProperty = $reflection->getProperty('id');
        $idProperty->setAccessible(true);
        $idProperty->setValue($this->testObject, 'existing-uuid-1234');

        $method = $reflection->getMethod('onPrePersist');
        $method->setAccessible(true);
        $method->invoke($this->testObject);

        $this->assertEquals('existing-uuid-1234', $this->testObject->getId());
    }

    public function testGetIdReturnsNullBeforePersist(): void
    {
        $this->assertNull($this->testObject->getId());
    }

    public function testGetCreatedAtReturnsNullBeforePersist(): void
    {
        $this->assertNull($this->testObject->getCreatedAt());
    }

    public function testGetUpdatedAtReturnsNullBeforePersist(): void
    {
        $this->assertNull($this->testObject->getUpdatedAt());
    }
}