<?php
namespace App\Controller;
use App\Entity\Student;
use App\Entity\Course;
use App\Entity\Classes;
use App\Entity\StudentsGrades;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class StudentController extends Controller{

    /**
     * @Route("/", name="student_list")
     *@Method({"GET"})
     */
    public function index(){
       $students = $this->getDoctrine()->getRepository(Student::class)->findAll(); 
       return $this->render('Students/index.html.twig', array('students' => $students));
    }

    /**
     * @Route("/courses", name="course_list")
     *@Method({"GET"})
     */
    public function index_course(){
        $courses = $this->getDoctrine()->getRepository(Course::class)->findAll(); 
        return $this->render('Courses/index.html.twig', array('courses' => $courses));
     }

     /**
     * @Route("/classes", name="classes_list")
     *@Method({"GET"})
     */
    public function index_classes(){
        $classes = $this->getDoctrine()->getRepository(Classes::class)->findAll(); 
        return $this->render('Classes/index.html.twig', array('classes' => $classes));
     }

    



/**
 * @Route("/student/new", name = "new_student")
 * @Method({"GET","POST"})
 */
public function new(Request $request){
    $student = new Student();
    $studentsgrade = new StudentsGrades();
    
    $form2 = $this->createFormBuilder($studentsgrade, array('allow_extra_fields' =>true))
    ->add('course', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('class',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('grade',TextType::class,array('attr'=>array('class'=>'form-control'))) 
    ->getForm();
    $form2->handleRequest($request);
    $date_created = date("d-m-Y");


    $form = $this->createFormBuilder($student, array('allow_extra_fields' =>true))
    ->add('fname', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('lname',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('dob',TextType::class,array('attr'=>array('class'=>'form-control'))) 
    ->add('img',FileType::class,array('attr'=>array('class'=>'form-control','mapped'=>false,'label'=>'Please Upload')))
    ->add('save', SubmitType::class, array('label'=>'Create', 'attr'=>array('class'=>'btn btn-primary mt-4')
    ))
    ->getForm();
    $form->handleRequest($request);
    $studentsgrade->setTargetStudent($student);
    
    

    if($form->isSubmitted() && $form->isValid() && $form2->isSubmitted() && $form2->isValid()){
        $image = $form->get('img')->getData();
        $uploads_directory= $this->getParameter('uploads_directory');
        $imagename = md5(uniqid()) . '.' . $image->guessExtension();
        $student->setIMG($imagename);
        $image->move(
            $uploads_directory,
            $imagename
        );



        $student->setDateCreated($date_created);
        $student->setDateModified("0");
        $studentsgrade= $form2->getData();
        $student = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($student);
        $entityManager->persist($studentsgrade);
        $entityManager->flush();
        return $this->redirectToRoute('student_list');
    }
    return $this->render('students/new.html.twig', array("form"=>$form->createview(),"form2"=>$form2->createview()));

}


/**
 * @Route("/course/new", name = "new_course")
 * @Method({"GET","POST"})
 */
public function new_course(Request $request){
    $course = new Course();
    $date_created = date("d-m-Y");
    $form = $this->createFormBuilder($course)
    ->add('name', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('description',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('save', SubmitType::class, array('label'=>'Create', 'attr'=>array('class'=>'btn btn-primary mt-4')))
    ->getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $course->setDateCreated($date_created);
        $course->setDateModified("0");
        $course = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($course);
        $entityManager->flush();
        return $this->redirectToRoute('course_list');
    }
    return $this->render('courses/new.html.twig', array("form"=>$form->createview()));

}




/**
 * @Route("/classes/new", name = "new_classes")
 * @Method({"GET","POST"})
 */
public function new_classes(Request $request){
    $classes = new Classes();
    $date_created = date("d-m-Y");
    $form = $this->createFormBuilder($classes)
    ->add('name', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('section',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('save', SubmitType::class, array('label'=>'Create', 'attr'=>array('class'=>'btn btn-primary mt-4')))
    ->getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $classes->setDateCreated($date_created);
        $classes->setDateModified("0");
        $classes = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($classes);
        $entityManager->flush();
        return $this->redirectToRoute('classes_list');
    }
    return $this->render('classes/new.html.twig', array("form"=>$form->createview()));

}


/**
 * @Route("/grades/new/{id}", name = "new_grades")
 * @Method({"GET","POST"})
 */
public function new_grade(Request $request, $id){
    $studentsgrade = new StudentsGrades();
    $student = new Student();
    //see how to get the id of the student that you just added the grades to,then store this in studentsgrades's
    // target_student...
    $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
    $studentsgrade->setTargetStudent($student); 
    
    

     
    // $student_id = $this->getDoctrine()->getRepository(StudentsGrades::class)->findBy(array('target_student'=>$id));
    // $studentsgrade->setTargetStudent($student);
    $form = $this->createFormBuilder($studentsgrade)
    ->add('course', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('class',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('grade',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('save', SubmitType::class, array('label'=>'Create', 'attr'=>array('class'=>'btn btn-primary mt-4')))
    ->getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $studentsgrade = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($studentsgrade);
        $entityManager->flush();
        return $this->redirectToRoute('student_list');
    }
    return $this->render('grades/new.html.twig', array("form"=>$form->createview()));

}


/**
 * @Route("/student/edit/{id}", name = "edit_student")
 * @Method({"GET","POST"})
 */
public function edit_student(Request $request, $id){
    $student = new Student();
    $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
    $date_modified = date("d-m-Y");
    $form = $this->createFormBuilder($student)
    ->add('fname', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('lname',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('dob',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('img', FileType::class, array('data_class' => null))
    ->add('save', SubmitType::class, array('label'=>'Update', 'attr'=>array('class'=>'btn btn-primary mt-4')
    ))
    ->getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $image = $form->get('img')->getData();
        $uploads_directory= $this->getParameter('uploads_directory');
        $imagename = md5(uniqid()) . '.' . $image->guessExtension();
        $student->setIMG($imagename);
        $image->move(
            $uploads_directory,
            $imagename
        );
        
        
        
        $student->setDateModified($date_modified);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('student_list');
    }
    return $this->render('students/edit.html.twig', array("form"=>$form->createview()));

}





/**
 * @Route("/course/edit/{id}", name = "edit_course")
 * @Method({"GET","POST"})
 */
public function edit_course(Request $request, $id){
    $course = new Course();
    $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
    $date_modified = date("d-m-Y");
    $form = $this->createFormBuilder($course)
    ->add('name', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('description',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('save', SubmitType::class, array('label'=>'Update', 'attr'=>array('class'=>'btn btn-primary mt-4')
    ))
    ->getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $course->setDateModified($date_modified);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('course_list');
    }
    return $this->render('courses/edit.html.twig', array("form"=>$form->createview()));

}


/**
 * @Route("/classes/edit/{id}", name = "edit_classes")
 * @Method({"GET","POST"})
 */
public function edit_classes(Request $request, $id){
    $classes = new Classes();
    $classes = $this->getDoctrine()->getRepository(Classes::class)->find($id);
    $date_modified = date("d-m-Y");
    $form = $this->createFormBuilder($classes)
    ->add('name', TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('section',TextType::class,array('attr'=>array('class'=>'form-control')))
    ->add('save', SubmitType::class, array('label'=>'Update', 'attr'=>array('class'=>'btn btn-primary mt-4')
    ))
    ->getForm();
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
        $classes->setDateModified($date_modified);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('classes_list');
    }
    return $this->render('classes/edit.html.twig', array("form"=>$form->createview()));

}






/**
 * @Route("/grade/delete/{id}")
 * @Method({"DELETE"})
 */
public function delete_grade(Request $request, $id){
    $studentsgrade = $this->getDoctrine()->getRepository(StudentsGrades::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($studentsgrade);
    $entityManager->flush();

    $response = new Response();
    $response->send();
        
}





/**
 * @Route("/student/delete/{id}")
 * @Method({"DELETE"})
 */
public function delete(Request $request, $id){
    $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
    
    $studentsgrade_fromdb = $this->getDoctrine()->getRepository(StudentsGrades::class)->findBy(array('target_student'=>$id));
    $entityManager = $this->getDoctrine()->getManager();
    if($studentsgrade_fromdb!=null){
        $studentsgrade = $this->getDoctrine()->getRepository(StudentsGrades::class)->find($studentsgrade_fromdb[0]);
        $entityManager->remove($studentsgrade);
        $entityManager->flush();
    }
    

    $entityManager->remove($student);
    $entityManager->flush();

    $response = new Response();
    $response->send();
        
}

/**
 * @Route("/course/delete/{id}")
 * @Method({"DELETE"})
 */
public function delete_course(Request $request, $id){
    $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($course);
    $entityManager->flush();

    $response = new Response();
    $response->send();
        
}


/**
 * @Route("/classes/delete/{id}")
 * @Method({"DELETE"})
 */
public function delete_class(Request $request, $id){
    $classes = $this->getDoctrine()->getRepository(Classes::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($classes);
    $entityManager->flush();

    $response = new Response();
    $response->send();
        
}

/**
 * @Route("/course/{id}")
 */
    public function show_course($id){
    $course = $this->getDoctrine()->getRepository(Course::class)->find($id);
    return $this->render('courses/show.html.twig', array('course'=>$course));
    }

/**
 * @Route("/student/{id}", name="student_show")
 */
    public function show($id){
    $student = $this->getDoctrine()->getRepository(Student::class)->find($id);
    $studentsgrade = $this->getDoctrine()->getRepository(StudentsGrades::class)->findBy(array('target_student'=>$id));  
    return $this->render('students/show.html.twig', array('student'=>$student,'studentsgrades'=>$studentsgrade));
    }


    /**
 * @Route("/classes/{id}")
 */
    public function show_class($id){
    $classes = $this->getDoctrine()->getRepository(Classes::class)->find($id);
    return $this->render('classes/show.html.twig', array('classes'=>$classes));
    }




    
}