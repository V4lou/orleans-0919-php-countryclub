<?php
namespace App\Controller;

use App\Model\AdminCountryDayManager;

class AdminCountryDayController extends AbstractController
{
    public function add()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminCountryDay = new AdminCountryDayManager();
            $data = array_map('trim', $_POST);
            $errors = $this->validate($data);
            if (empty($errors)) {
                if ($_FILES['file']['size'] <= $data['MAX_FILE_SIZE']) {
                    $odlDest = $_FILES['file']['tmp_name'];
                    $newDest = 'assets/upload/'.$_FILES['file']['name'];
                    move_uploaded_file($odlDest, $newDest);
                }
                $adminCountryDay->insert($data);
                header('Location: CountryDay/add/');
            }
        }
        return $this->twig->render('CountryDay/add.html.twig', [
            'errors' => $errors,
            'data' => $data ?? null,
        ]);
    }
    private function validate(array $data): array
    {
        if (empty($data['subtitle'])) {
            $errors['subtitle'] = "The title is required ";
        }
        if (empty($data['description'])) {
            $errors['description'] = "Description of Country Day is required ";
        }
        if (empty($_FILES['file']['name'])) {
            $errors['file'] = "Country Days's image is required ";
        }
        if (empty($_FILES['media']['name'])) {
            $errors['media'] = "Country Days's movie is required ";
        }
        if (empty($data['date'])) {
            $errors['date'] = "Date must be current Date";
        }
        return $errors ?? [];
    }
}