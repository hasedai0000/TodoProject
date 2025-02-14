/**
 * useAuth
 *
 * @package hooks
 */

import { UserType } from '@/interfaces/User';
import { useRouter } from 'next/router';
import { useCallback, useState } from 'react';

/**
 * useAuth
 *
 * @returns
 */
export const useAuth = () => {
  const router = useRouter();
  const [user, setUser] = useState<UserType | undefined>(undefined);
  const [isAuth, setIsAuth] = useState<boolean>(false);

  /**
   * グローバルの認証状態をログイン済みにする
   */
  const signIn = useCallback(async (user: UserType) => {
    setUser(user);
    setIsAuth(true);
  }, []);

  return { user, isAuth, signIn };
};
