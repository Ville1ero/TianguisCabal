<?php
/**
 * CRUD for Food
 * @package TianguisCabal
 * @author Roberto Villegas <ville1ero@gmail.com>
 */

//creamos la clase
class FoodController extends Controller {

  //funcion publica que crea vista
  public function indexAction(){
	//creamos la vista
    $View = new View('food/list');
	//indicamos el titulo
    $View->assign('_title_', _('Cena Cabal'));
	//Category Model extiende del DAO carga de la base de datos la tabla food
    $Foods = FoodModel::getAll();
	//asignamos variable de campo y valor
    $View->assign('foods', $Foods);
	//Mostramos la vista
    $View->display();
  }
  
  public function viewAction(){
    $Request = Request::getInstance();
    
    $View = new View('food/view');
    $View->assign('_title_', _('View Food'));
    
    $id = ( isset($Request->id) )?(int)$Request->id:0;
    
    $Food = new FoodModel($id);
    
    if ( !$Food->load() ) {
      $_SESSION['_MESSAGE_'] = _('That Category doesn\'t exists');
      header('Location: ' . BASE_URL . '/food');
      exit();
    }
    
    $View->assign('Food', $Food);
    $View->display();
  }
  
  public function editAction(){
    $Request = Request::getInstance();
    
    $View = new View('food/edit');
    $View->assign('_title_', _('Edit Food'));
    
    $id = ( isset($Request->id) )?(int)$Request->id:0;
    $Food = new FoodModel($id);
    $Food->load();
    
    $View->assign('Food', $Food);
    $View->display();
  }
  
  /**
   *
   * @return unknown_type
   * @todo $_POST shouldn't be used, check how this can be integrated with {@link Request}
   */
  public function saveAction(){
  	
    $View = new View('food/edit');
    $View->assign('_title_', _('Save Food'));
    
    $id = ( isset($_POST['OrdenID']) )?(int)$_POST['OrdenID']:0;
    
    $Food = new FoodModel($id);
    $Food->load();
    
    $Food->Comida = $_POST['Comida'];
    $Food->Name=$_POST['Name'];
    $Food->Fecha=$_POST['Fecha'];
    
    if ( !$Food->save() ) {
      $_SESSION['_MESSAGE_'] = _('Couldn\'t save Order');
      header('Location: ' . BASE_URL . '/food');
      exit();
    }
    
    $_SESSION['_MESSAGE_'] = _('Saved');
    if ( $id == 0 ) {
      $DbConnection=DbConnection::getInstance();
      $id = $DbConnection->getLastId();
    }
    header('Location: ' . BASE_URL . "/food/view/?id=$id");
  }
  
  public function deleteAction() {
    $Request = Request::getInstance();
    $id = ( isset($Request->id) )?(int)$Request->id:0;
    
    $Food = new FoodModel($id);
    
    if ( !$Food->load() ) {
      $_SESSION['_MESSAGE_'] = _('That Food doesn\'t exists');
      header('Location: ' . BASE_URL . '/food');
      exit();
    }
    
    if ( !$Food->delete() ) {
      $_SESSION['_MESSAGE_'] = _('Couldn\'t delete Food');
      header('Location: ' . BASE_URL . '/food');
      exit();
    }
    
    $_SESSION['_MESSAGE_'] = _('Deleted');
    header('Location: ' . BASE_URL . '/food');
    exit();
    
    
  }
}