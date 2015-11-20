<?php

use Illuminate\Database\Seeder;
use Faker\Generator;
use App\Eloquent\Guru;

class GuruTableSeeder extends Seeder
{
	/**
	 * Faker Service
	 * 
	 * @var Faker\Generator
	 */
	protected $faker;

	/**
	 * Guru Eloquent Model
	 * 
	 * @var App\Eloquent\Guru
	 */
	protected $guru;

	/**
	 * Class Constructor!
	 * 
	 * @param Generator $faker
	 */
	public function __construct(Generator $faker, Guru $guru)
	{
		$this->faker = \Faker\Factory::create('id_ID');
		$this->guru = $guru;
	}


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$nip = 610300751;

    	for ($i=1; $i<=50; $i++) {
    		$this->guru->create([
    			'nama' => $this->faker->name,
    			'nip' => (string) ($nip + $i),
    		]);
    	}
    }
}
