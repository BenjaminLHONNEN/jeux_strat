<?php
/**
 * Created by PhpStorm.
 * User: probe
 * Date: 12/10/2017
 * Time: 11:58
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

class SingUpController extends Controller
{
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