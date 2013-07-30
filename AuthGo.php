<?php
class AuthGo extends CApplicationComponent
{
    public $hasil=array();
    
    public function init()
    {
       // apa aja boleh;
    }
    /**
     * @var $keyword merupakan deretan kata yg dipisahkan dengan , tanpa spasi
     * @var $stringSearch merupakan kalimat yg akan dicari
     * @return mengembalikan nilai true jika ditemukan kata yg sama
     */
    public static function listAccess()
  {
		$hasil=array();
		
		/* @var $am CAuthManager|AuthBehavior */
		$am = Yii::app()->getAuthManager();

		
		$assignments = $am->getAuthAssignments( Yii::app()->user->id );
		$permissions = $am->getItemsPermissions(array_keys($assignments));
		foreach ($permissions as $itemPermission)
		{
			echo $itemPermission['item']->type.' '.$itemPermission['item']->description;
		}
	}
	
	public static function listRoles()
	{
		$hasil=array();
		
		/* @var $am CAuthManager|AuthBehavior */
		$am = Yii::app()->getAuthManager();

		if( isset(Yii::app()->user->id) )
		{
			$assignments = $am->getAuthAssignments( Yii::app()->user->id );
			$permissions = $am->getItemsPermissions(array_keys($assignments));
			foreach ($permissions as $itemPermission)
			{
				if($itemPermission['item']->type==2)
					$hasil[]=$itemPermission['item'];
				//echo $itemPermission['item']->type.' '.$itemPermission['item']->description;
			}
			
			return $hasil;
		}
		else
			return $hasil;
	}
	
	public static function listTasks()
	{
		$hasil=array();
		
		/* @var $am CAuthManager|AuthBehavior */
		$am = Yii::app()->getAuthManager();

		if( isset(Yii::app()->user->id) )
		{
			$assignments = $am->getAuthAssignments( Yii::app()->user->id );
			$permissions = $am->getItemsPermissions(array_keys($assignments));
			foreach ($permissions as $itemPermission)
			{
				if($itemPermission['item']->type==1)
					$hasil[]=$itemPermission['item'];
				//echo $itemPermission['item']->type.' '.$itemPermission['item']->description;
			}
			
			return $hasil;
		}
		else
			return $hasil;
	}
	
	public static function listOperations()
	{
		$hasil=array();
		
		/* @var $am CAuthManager|AuthBehavior */
		$am = Yii::app()->getAuthManager();

		if( isset(Yii::app()->user->id) )
		{
			$assignments = $am->getAuthAssignments( Yii::app()->user->id );
			$permissions = $am->getItemsPermissions(array_keys($assignments));
			foreach ($permissions as $itemPermission)
			{
				if($itemPermission['item']->type==0)
					$hasil[]=$itemPermission['item'];
				//echo $itemPermission['item']->type.' '.$itemPermission['item']->description;
			}
			
			return $hasil;
		}
		else
			return $hasil;
	}
	
	public static function listUserRoles($item_name) //$item_name ===>> adalah role user
	{
		//Yii::app()->user->checkAccess('dokter')
		/* @var $user CWebUser */
		//$user = Yii::app()->getUser();
		$am = Yii::app()->getAuthManager();
		
		$hasil=array();
		$Users=User::model()->active()->findAll();
		
		foreach ($Users as $user)
		{
			$assignments = $am->getAuthAssignment( $item_name, $user->id );
			
			if( $assignments != NULL ) 
				$hasil = $hasil + array( $user->id => $user->profile->firstname.' '.$user->profile->lastname );
		}
		
		return $hasil;
	}
}
?>
