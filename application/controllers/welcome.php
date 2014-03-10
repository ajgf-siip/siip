<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

//use MainController;

class Welcome extends CI_Controller {

	public $em;

	function __construct() {
		parent::__construct();
		$this -> em = $this -> doctrine -> em;
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		//$this->load->view('welcome_message');
		//$userRepository = $this -> em -> getRepository('Entity/User');
		//$users = $userRepository -> findAll();
		//$users = $this->em->findAll('Entity\User');
		$user = $this -> em -> find('Entity\User', 2);

		//foreach ($users as $user) {
		echo sprintf("-%s\n", $user -> getFirstname(). " <br/>");
		//}
		$user = $this -> em -> getRepository('Entity\User') -> findOneBy(array('email' => 'paxm@gmail.com'));
		echo $user -> getFirstname() . ' ' . $user -> getLastname() . ' is glad he isn\'t dealing with Symfony.<br />';

		$q = $this -> em -> createQuery('select u from Entity\User u where u.firstname = ?1');
		$q -> setParameter(1, 'Pax');
		$garfield = $q -> getSingleResult();

		echo "Hello " . $garfield -> getLastname() . " ! <br/>";

	}

	public function save() {
		$user = new Entity\User;
		$user -> setPassword('ajgf');
		$user -> setEmail('ajgf@gmail.com');
		$user -> setFirstname('AJGF');
		$user -> setLastname('SIIP');

		$this -> em -> persist($user);
		$this -> em -> flush();
	}

	public function test() {
		/*code commenté
		 * 
		 * $this -> load -> helper(array('form', 'url'));

		$this -> load -> library('form_validation');

		$this -> form_validation -> set_rules('username', 'Username', 'required');
		$this -> form_validation -> set_rules('password', 'Password', 'required');
		$this -> form_validation -> set_rules('passconf', 'Password Confirmation', 'required');
		$this -> form_validation -> set_rules('email', 'Email', 'required');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> load -> view('myform');
		} else {
			$this -> load -> view('formsuccess');
		}

		echo base_url();*/
		$this -> load -> view('signup');
	}

	private function _submit_validate() {

		// validation rules
		$this -> form_validation -> set_rules('username', 'Username', 'required|alpha_numeric|min_length[6]|max_length[12]|unique[User.username]');
		$this -> form_validation -> set_rules('email', 'E-mail', 'required|valid_email|unique[User.email]');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
