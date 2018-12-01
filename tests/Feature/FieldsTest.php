<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Subscribers;
use App\Fields;

class FieldsTest extends TestCase
{
    public function testFieldCreate()
    {
        $subscriber = factory(Subscribers::class)->create();
        $field = factory(Fields::class)->make([
            'subscriber_id' => $subscriber->id,
        ]);

        $this->json('POST', 'api/fields',
            ["type"=>$field->type, "value"=>$field->value, "title"=>$field->title, "subscriber_id"=>$field->subscriber_id]
        )
            ->assertJsonStructure([
                "title",
                "type",
                "value",
                "id",
                "subscriber_id"
            ]);
    }

    public function testFieldCreateExisting()
    {
        $subscriber = factory(Subscribers::class)->create();
        $field = factory(Fields::class)->create([
            'subscriber_id' => $subscriber->id,
        ]);

        $this->json('POST', 'api/fields', ["type" => $field->type, "value" => $field->value, "title" => $field->title, "subscriber_id" => $field->subscriber_id ])
            ->assertJsonStructure([
                "error",
            ]);
    }

    public function testRequiredFields()
    {
        $subscriber = factory(Subscribers::class)->create();
        $payload = ["type" => "number", "subscriber_id" => $subscriber->id ];

        $this->json('POST', 'api/fields', $payload)
            ->assertJsonStructure([
                "error"
            ]);

        $payload = ["subscriber_id" => $subscriber->id ];

        $this->json('POST', 'api/fields', $payload)
            ->assertJsonStructure([
                "error"
            ]);

        $payload = [ ];

        $this->json('POST', 'api/fields', $payload)
            ->assertJsonStructure([
                "error"
            ]);
    }

    public function testFieldGet()
    {
        $subscriber = factory(Subscribers::class)->create();
        $field = factory(Fields::class)->create([
            'subscriber_id' => $subscriber->id,
        ]);

        $this->json('GET', 'api/fields/' . $field->id)
            ->assertJsonStructure([
                "title",
                "value",
                "type",
                "subscriber_id",
            ]);
    }

    public function testFieldGetBySubscriber()
    {
        $subscriber = factory(Subscribers::class)->create();
        $field = factory(Fields::class)->create([
            'subscriber_id' => $subscriber->id,
        ]);

        $this->json('GET', 'api/fields/getSubscriberFields/' . $subscriber->id)
            ->assertOK();
    }

    public function testFieldEdit()
    {
        $faker = \Faker\Factory::create();
        $subscriber = factory(Subscribers::class)->create();

        $field = factory(Fields::class)->create([
            'subscriber_id' => $subscriber->id,
        ]);

        $payload = ["title"=> $faker->unique()->randomNumber ];

        $this->json('PUT', 'api/fields/' . $field->id, $payload)
            ->assertJson([
                "title"=>$payload["title"]
            ]);
    }

    public function testSFieldEditMissing()
    {
        $faker = \Faker\Factory::create();
        $payload = ["title"=> $faker->unique()->randomNumber];

        $this->json('PUT', 'api/fields/' . -1, $payload)
            ->assertJsonStructure([
                "error"
            ]);
    }

    public function testFieldDelete()
    {
        $subscriber = factory(Subscribers::class)->create();
        $field = factory(Fields::class)->create([
            'subscriber_id' => $subscriber->id,
        ]);

        $this->json("delete", 'api/fields/' . $field->id)
            ->assertOk();

        $this->json("GET", "api/fields/" . $field->id )
            ->assertSee(null);
    }
}
