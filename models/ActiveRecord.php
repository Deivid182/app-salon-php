<?php

namespace Model;

class ActiveRecord
{

	// Base DE DATOS
	protected static $db;
	protected static $table = '';
	protected static $columnsDB = [];
	protected $id;

	// Alertas y Mensajes
	protected static $alerts = [];

	// Definir la conexión a la BD - includes/database.php
	public static function setDB($database)
	{
		self::$db = $database;
	}

	public static function setAlert($tipo, $mensaje)
	{
		static::$alerts[$tipo][] = $mensaje;
	}

	// Validación
	public static function getAlerts()
	{
		return static::$alerts;
	}

	public function validate()
	{
		static::$alerts = [];
		return static::$alerts;
	}

	// Consulta SQL para create un objeto en Memoria
	public static function querySQL($query)
	{
		// Consultar la base de datos
		$result = self::$db->query($query);

		// Iterar los resultados
		$array = [];
		while ($record = $result->fetch_assoc()) {
			$array[] = static::createObject($record);
		}

		// liberar la memoria
		$result->free();

		// retornar los resultados
		return $array;
	}

	// Crea el objeto en memoria que es igual al de la BD
	protected static function createObject($record)
	{
		$object = new static;

		foreach ($record as $key => $value) {
			if (property_exists($object, $key)) {
				$object->$key = $value;
			}
		}

		return $object;
	}

	// Identificar y unir los attributes de la BD
	public function attributes()
	{
		$attributes = [];
		foreach (static::$columnsDB as $column) {
			if ($column === 'id') continue;
			$attributes[$column] = $this->$column;
		}
		return $attributes;
	}

	// Sanitizar los datos antes de guardarlos en la BD
	public function cleanAttributes()
	{
		$attributes = $this->attributes();
		$clean = [];
		foreach ($attributes as $key => $value) {
			$clean[$key] = self::$db->escape_string($value);
		}
		return $clean;
	}

	// Sincroniza BD con Objetos en memoria
	public function syncUp($args = [])
	{
		foreach ($args as $key => $value) {
			if (property_exists($this, $key) && !is_null($value)) {
				$this->$key = $value;
			}
		}
	}

	// Registros - CRUD
	public function save()
	{
		$result = '';
		if (!is_null($this->id)) {
			// update
			$result = $this->update();
		} else {
			// Creando un nuevo record
			$result = $this->create();
		}
		return $result;
	}

	// Todos los registros
	public static function all()
	{
		$query = "SELECT * FROM " . static::$table;
		$result = self::querySQL($query);
		return $result;
	}

	// Busca un record por su id
	public static function find($id)
	{
		$query = "SELECT * FROM " . static::$table  . " WHERE id = $id";
		$result = self::querySQL($query);
		return array_shift($result);
	}

	// Obtener Registros con cierta cantidad
	public static function get($limit)
	{
		$query = "SELECT * FROM " . static::$table . " LIMIT $limit";
		$result = self::querySQL($query);
		return array_shift($result);
	}

	// crea un nuevo record
	public function create()
	{
		// Sanitizar los datos
		$attributes = $this->cleanAttributes();

		// Insertar en la base de datos
		$query = " INSERT INTO " . static::$table . " ( ";
		$query .= join(', ', array_keys($attributes));
		$query .= " ) VALUES (' ";
		$query .= join("', '", array_values($attributes));
		$query .= " ') ";

		// Resultado de la consulta
		$result = self::$db->query($query);
		return [
			'result' =>  $result,
			'id' => self::$db->insert_id
		];
	}

	// update el record
	public function update()
	{
		// Sanitizar los datos
		$attributes = $this->cleanAttributes();

		// Iterar para ir agregando cada campo de la BD
		$valores = [];
		foreach ($attributes as $key => $value) {
			$valores[] = "{$key}='{$value}'";
		}

		// Consulta SQL
		$query = "UPDATE " . static::$table . " SET ";
		$query .=  join(', ', $valores);
		$query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
		$query .= " LIMIT 1 ";

		// update BD
		$result = self::$db->query($query);
		return $result;
	}

	// Eliminar un Registro por su ID
	public function delete()
	{
		$query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
		$result = self::$db->query($query);
		return $result;
	}
	public static function where($column, $value)
	{
		$query = "SELECT * FROM " . static::$table  . " WHERE $column = '$value'";
		$result = self::querySQL($query);
		return array_shift($result);
	}

	public static function customSQL($query)
	{
		$result = self::querySQL($query);
		return $result;
	}
}
