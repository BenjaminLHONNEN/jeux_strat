<?php
/**
 * Created by PhpStorm.
 * User: Ulric
 * Date: 28/09/2017
 * Time: 12:36
 */

namespace GameBundle\Controller;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use GameBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends Controller
{
    /**
     * @Route("/user/sign/in", name="login")
     */
    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('GameBundle:Game:signIn.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/user/sign/up", name="signUp")
     */
    public function signAction(Request $request)
    {
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $passEncoder = $this->get("security.password_encoder");

        $form = $this->createFormBuilder($user)
            ->add('pseudo', TextType::class, array('label' => 'Pseudo : '))
            ->add('mail', TextType::class, array('label' => 'Mail : '))
            ->add('password', TextType::class, array('label' => 'Password : '))
            ->add('imageLink', FileType::class, array('label' => 'Image (png,gif,jpg) : '))
            ->add('save', SubmitType::class, array('label' => 'Sign Up'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $user->getImageLink();

            $user->setPassword($passEncoder->encodePassword($user,$user->getPassword()));
            $user->setRole("ROLE_USER");
            $user->setImageLink("none");

            $em->persist($user);
            $em->flush();

            $fileName = "./asset/userImages/" . $user->getId() . ".gif";
            $user->setImageLink($fileName);
            $file->move(
                $this->getParameter('user_image_directory'),
                $fileName
            );
            $em->persist($user);
            $em->flush();
        }

        return $this->render('GameBundle:Game:signUp.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}