<?php

	/*******************************************************************************
	* Copyright 2010 Silas Ribas Martins
	* 
	* XPM4Izzy version 0.1
	*
	* XPM4Izzy is a interface for integration of the XPertMailer with Izzy Framework.
	* 
	* XPM4Izzy using a version 0.5 of XPM4 
	* 
	* XPM4Izzy is free software; you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation; either version 2 of the License, or
	* (at your option) any later version.
	* 
	* XPM4Izzy is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.
	* 
	* You should have received a copy of the GNU General Public License
	* along with Izzy Framework; if not, write to the Free Software
	* Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	* 
	* XPertMailer is licensed with CC-GNU LGPL. For much informations visit
	* a XPertMailer Website in http://www.xpertmailer.com/
	* 
	*******************************************************************************/

	class XPM4Izzy extends Controller
	{
		public $mail;
		public $connect;
		
		public function __construct()
		{
			define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors
			$this->mail = new Izzy::$utils->XPM->MAIL5(); // initialize MAIL class
			
			return $this;
		}
		
		public function setFrom( $addr = null, $name = null, $charset = null, $encoding = null, $debug = null )
		{
			$this->mail->From( $addr, $name, $charset, $encoding, $debug ); // set from address
			
			return $this;
		}
		
		public function setTo( $emailTo = null, $nameTo = null, $charset = null, $encoding = null, $debug = null )
		{
			$this->mail->AddTo( $emailTo, $nameTo, $charset, $encoding, $debug ); // add to address
			
			return $this;
		}
		
		public function setSubject( $subject )
		{
			$this->mail->Subject( $subject ); // set subject
			
			return $this;
		}
		
		public function setTextMessage( $message )
		{
			$this->mail->Text( strip_tags( $message ) ); // set text message
			
			return $this;
		}
		
		public function setHTMLMessage( $message )
		{
			$this->mail->Html( $message ); // set html message
			
			return $this;
		}

		public function setSMTP( $host = null, $port = null, $user = null, $pass = null, $vssl = null, $tout = null, $name = null, $context = null, $auth = null, $debug = null )
		{
			if( !$this->connect = $this->mail->Connect( $host, $port, $user, $pass, $vssl, $tout, $name, $context, $auth, $debug ) )
			{
				throw new Exception( "Can't connect to SMTP server. Error: " . $this->mail->result );
			}
			
			return $this;
		}
		
		public function getEmail()
		{
			// For use all methods of XPM then XPM4Izzy not support
			return $this->mail;
		}
		
		public function envia()
		{
			// send mail relay using the '$c' resource connection
			$retorno = $this->mail->Send( $this->connect  ) ? true : false;
			
			$this->mail->Disconnect(); // disconnect from server
			
			return array( 'retorno' => $retorno );
		}
	}

?>