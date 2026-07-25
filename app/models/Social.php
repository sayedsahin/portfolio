<?php 
namespace App\Models;
use App\Systems\QueryBuilder;

class Social extends QueryBuilder
{
	protected string $defaultTable = 'socials';
}