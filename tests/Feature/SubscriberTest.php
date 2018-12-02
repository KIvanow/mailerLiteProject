<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Subscribers;

class SubscriberCreateTest extends TestCase
{
    public function testRequiresEmailAndName()
    {
        $faker = \Faker\Factory::create();
        $payload = ['email' => $faker->unique()->safeEmail];

        $response = $this->json('POST', 'api/subscribers', $payload);
        $response->assertStatus(422);
    }

    public function testCreatingNewSubscriber()
    {
        $faker = \Faker\Factory::create();
        $payload = ['email' => $faker->unique()->safeEmail, 'name' => 'testUser'];

        $this->json('POST', 'api/subscribers', $payload)
            ->assertJsonStructure([
                "email",
                "id",
                "name",
            ]);

    }

    public function testCreatingExistingSubscriber()
    {
        $subscriber = factory(Subscribers::class)->create();

        $payload = ['email' => $subscriber->email, 'name' => $subscriber->name];

        $response = $this->json('POST', 'api/subscribers', $payload);
        $response->assertStatus(422);
    }

    public function testSubscriberGet()
    {
        $subscriber = factory(Subscribers::class)->create();

        $this->json('GET', 'api/subscribers/' . $subscriber->id)
            ->assertJsonStructure([
                "email",
                "id",
                "name",
            ]);
    }

    public function testSubscriberEdit()
    {
        $subscriber = factory(Subscribers::class)->create();

        $faker = \Faker\Factory::create();
        $payload = ["email"=> $faker->unique()->safeEmail];

        $this->json('PUT', 'api/subscribers/' . $subscriber->id, $payload)
            ->assertJson([
                "email"=>$payload["email"]
            ]);
    }

    public function testSubscriberDelete()
    {
        $subscriber = factory(Subscribers::class)->create();

        $this->json("delete", 'api/subscribers/' . $subscriber->id)
            ->assertOk();
    }
}
