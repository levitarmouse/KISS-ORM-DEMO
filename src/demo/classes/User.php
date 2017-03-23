<?php
/*
 * CODIGO AUTOGENERADO POR kissDesc. KISS-ORM
 */

namespace demo\classes;

/**
 * Description of User
 *
 * @property $user_id              int(11)
 * @property $real_name            varchar(50)
 * @property $user_name            varchar(20)
 * @property $mail                 varchar(100)
 * @property $password             varchar(100)
 * @property $image                varchar(256)
 * @property $disable              tinyint(1)
 * @property $theme_id             int(11)
 * @property $logued               tinyint(1)
 * @property $creation_date        datetime
 * @property $last_login           bigint(20)
 * @property $token                varchar(255)

 */
class User extends \levitarmouse\kiss_orm\EntityModel
{

}
