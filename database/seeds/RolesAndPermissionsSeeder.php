<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // post permissions
        Permission::create(['name' => 'create.posts', 'description' => 'Creación de posts (Permite crear nuevos posts)']);
        Permission::create(['name' => 'show.posts', 'description' => 'Lectura de posts (Permite navegar por los posts creados)']);
        Permission::create(['name' => 'edit.posts', 'description' => 'Edición de posts (Permite editar los posts creados)']);
        Permission::create(['name' => 'delete.posts', 'description' => 'Eliminación de posts (Permite eliminar los posts creados)']);

        // tags permissions
        Permission::create(['name' => 'create.tags', 'description' => 'Creación de etiquetas (Permite crear nuevos etiquetas)']);
        Permission::create(['name' => 'show.tags', 'description' => 'Lectura de etiquetas (Permite navegar por los etiquetas creados)']);
        Permission::create(['name' => 'edit.tags', 'description' => 'Edición de etiquetas (Permite editar los etiquetas creados)']);
        Permission::create(['name' => 'delete.tags', 'description' => 'Eliminación de etiquetas (Permite eliminar los etiquetas creados)']);

        // comment permissions
        Permission::create(['name' => 'create.comments', 'description' => 'Creación de comentarios (Permite crear nuevos comentarios)']);
        Permission::create(['name' => 'show.comments', 'description' => 'Lectura de comentarios (Permite navegar por los comentarios creados)']);
        Permission::create(['name' => 'edit.comments', 'description' => 'Edición de comentarios (Permite editar los comentarios creados)']);
        Permission::create(['name' => 'delete.comments', 'description' => 'Eliminación de comentarios (Permite eliminar los comentarios creados)']);

        // category permissions
        Permission::create(['name' => 'create.categories', 'description' => 'Creación de categorías (Permite crear nuevas categorías)']);
        Permission::create(['name' => 'show.categories', 'description' => 'Lectura de categorías (Permite navegar por las categorías creadas)']);
        Permission::create(['name' => 'edit.categories', 'description' => 'Edición de categorías (Permite editar las categorías creadas)']);
        Permission::create(['name' => 'delete.categories', 'description' => 'Eliminación de categorías (Permite eliminar las categorías creadas)']);

        // users permissions
        Permission::create(['name' => 'create.users', 'description' => 'Creación de usuarios (Permite crear nuevos usuarios)']);
        Permission::create(['name' => 'show.users', 'description' => 'Lectura de usuarios (Permite navegar por los usuarios creados)']);
        Permission::create(['name' => 'edit.users', 'description' => 'Edición de usuarios (Permite editar los usuarios creados)']);
        Permission::create(['name' => 'delete.users', 'description' => 'Eliminación de usuarios (Permite eliminar los usuarios creados)']);

        // role permissions
        Permission::create(['name' => 'create.roles', 'description' => 'Creación de roles (Permite crear nuevos roles)']);
        Permission::create(['name' => 'show.roles', 'description' => 'Lectura de roles (Permite navegar por los roles creados)']);
        Permission::create(['name' => 'edit.roles', 'description' => 'Edición de roles (Permite editar los roles creados)']);
        Permission::create(['name' => 'delete.roles', 'description' => 'Eliminación de roles (Permite eliminar los roles creados)']);

        // create roles and assign created permissions

        // this can be done as separate statements

        $guest = Role::create(['name' => 'guest', 'description' => 'Usuario con permisos de los comentarios']);
        $guest->givePermissionTo([
            'create.comments', 'show.comments', 'edit.comments', 'delete.comments'
        ]);

        $writer = Role::create(['name' => 'writer', 'description' => 'Escritor con permisos para crear, mostrar, editar y eliminar los posts']);
        $writer->givePermissionTo([
            'show.tags',
            'create.posts', 'show.posts', 'edit.posts', 'delete.posts'
        ]);

        $moderator = Role::create(['name' => 'moderator', 'description' => 'Moderador con permisos para administrar a los usuarios y las categorías y visualizar los posts']);
        $moderator->givePermissionTo([
            'show.posts',
            'show.comments', 'delete.comments',
            'create.tags', 'show.tags', 'edit.tags', 'delete.tags',
            'create.categories', 'show.categories', 'edit.categories', 'delete.categories',
            'create.users', 'show.users', 'edit.users', 'delete.users',
        ]);

        $admin = Role::create(['name' => 'admin', 'description' => 'Administrador con todos los permisos']);
        $admin->givePermissionTo(Permission::all());
    }
}
