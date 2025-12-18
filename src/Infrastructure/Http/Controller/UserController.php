<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller;

use App\Domain\Entity\User\UserRepositoryInterface;
use App\Domain\Service\Params\User\CreateUserParams;
use App\Domain\Service\User\UserService;
use App\Infrastructure\Http\Request\CreateUserRequest;
use App\Infrastructure\Security\SecurityUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/user', name: 'user')]
class UserController
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly SerializerInterface $serializer,
        private readonly DenormalizerInterface $denormalizer,
        private readonly ValidatorInterface $validator,
        private readonly UserPasswordHasherInterface $hasher,
    ) {
    }

    #[Route('/raw', name: '_create_raw', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $params = new CreateUserParams(
            $request->request->get('login'),
            $request->request->get('firstName'),
            $request->request->get('lastName'),
            $request->request->get('email'),
        );

        $service = new UserService($this->userRepository);
        $service->create($params);

        return new Response();
    }

    #[Route('/deserialize', name: '_create_deserialize', methods: ['POST'])]
    public function createDeserialize(Request $request, #[CurrentUser] SecurityUser $user): Response
    {
        /** @var CreateUserRequest $createUserRequest */
        $createUserRequest = $this->serializer->deserialize($request->getContent(), CreateUserRequest::class, 'json');
        $constraints = $this->validator->validate($createUserRequest);
        if (count($constraints) > 0) {
            throw new BadRequestHttpException();
        }

        $hashedPassword = $this->hasher->hashPassword(
            new SecurityUser(1, $createUserRequest->login, $createUserRequest->password),
            $createUserRequest->password
        );

        $params = $createUserRequest->toParams($hashedPassword);
        $service = new UserService($this->userRepository);
        $service->create($params);

        return new Response();
    }

    #[Route('/map', name: '_create_map', methods: ['POST'])]
    public function createMap(#[MapRequestPayload]CreateUserRequest $request): Response
    {
        $params = $request->toParams();
        $service = new UserService($this->userRepository);
        $service->create($params);

        return new Response();
    }
}
