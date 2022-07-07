<?php

	class Convo{
		//db stuff
		private $conn;
		private $table = 'invoice';

		//constructor with db
		public function __construct($db){
			$this->conn = $db;
			date_default_timezone_set("Asia/Dhaka");
		}

		public function read()
		{

			//create sql query
			$query = 'SELECT * FROM '. $this->table .' WHERE payment_date >= :from_date
						AND payment_date <= :to_date and payment_mode = :payment_mode ORDER BY payment_date DESC';
			//$query = 'SELECT * FROM '. $this->table .' WHERE invoice_id = ?';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//clean data
			$this->from_date = htmlspecialchars(strip_tags($this->from_date));
			$this->to_date = htmlspecialchars(strip_tags($this->to_date));
			$this->payment_mode = htmlspecialchars(strip_tags($this->payment_mode));


			//Bind data
			$stmt->bindParam(':from_date',$this->from_date);
			$stmt->bindParam(':to_date',$this->to_date);
			$stmt->bindParam(':payment_mode',$this->payment_mode);

			//execute query
			$stmt->execute();

			return $stmt;
		}

		public function update()
		{

			//create sql query
			$query = 'UPDATE '. $this->table .' 
						SET 
							payment_mode = :payment_mode,
							transation_id = :transation_id,
							payment_amount = :payment_amount,
							payment_status = 1,
							payment_date = :payment_date
						WHERE
							invoice_id =:invoice_id
						AND
							payment_status = 0';

			//prepare statement
			$stmt = $this->conn->prepare($query);

			//clean data
			$this->payment_mode = htmlspecialchars(strip_tags($this->payment_mode));
			$this->transation_id = htmlspecialchars(strip_tags($this->transation_id));
			$this->payment_amount = htmlspecialchars(strip_tags($this->payment_amount));
			$this->payment_date = htmlspecialchars(strip_tags($this->payment_date));
			$this->invoice_id = htmlspecialchars(strip_tags($this->invoice_id));

			//Bind data
			$stmt->bindParam(':payment_mode',$this->payment_mode);
			$stmt->bindParam(':transation_id',$this->transation_id);
			$stmt->bindParam(':payment_amount',$this->payment_amount);
			$stmt->bindParam(':payment_date',$this->payment_date);
			$stmt->bindParam(':invoice_id',$this->invoice_id);


			//execute query
			$stmt->execute();
				
			$affected_row = $stmt->rowCount();
			if($affected_row > 0){
				return true;
			}
			
			return false;
		}


	}
?>