<?php

/**
 * opAuthValidatorMemberConfigAndPassword
 *
 * @package    OpenPNE
 * @subpackage validator
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 */
class opAuthValidatorMemberConfigAndPassword extends opAuthValidatorMemberConfig
{
  /**
   * @see opAuthValidatorMemberConfig
   */
  protected function configure($options = array(), $messages = array())
  {
    parent::configure($options, $messages);
    $this->setMessage('invalid', 'ID or password is not a valid.');
  }

  /**
   * @see opAuthValidatorMemberConfig
   */
  protected function doClean($values)
  {
    $values = parent::doClean($values);

    $valid_password = MemberConfigPeer::retrieveByNameAndMemberId('password', $values['member']->getId())->getValue();
    if (md5($values['password']) !== $valid_password)
    {
      throw new sfValidatorError($this, 'invalid');
    }

    return $values;
  }
}
