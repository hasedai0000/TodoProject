/**
 * AuthContext
 *
 * @package contexts
 */

import { useAuth } from '@/hooks/useAuth';
import { UserType } from '@/interfaces/User';
import { createContext, FC, ReactNode, useContext } from 'react';

type Props = {
  children: ReactNode;
};

type ContextType = {
  user: UserType | undefined;
  isAuth: boolean;
  signIn: (user: UserType) => Promise<void>;
};

const AuthContext = createContext({} as ContextType);

/**
 * AuthProvider
 *
 * @param children
 * @returns
 */
export const AuthProvider: FC<Props> = ({ children }) => {
  const { user, isAuth, signIn } = useAuth();

  return <AuthContext.Provider value={{ user, isAuth, signIn }}>{children}</AuthContext.Provider>;
};

export const useAuthContext = () => useContext(AuthContext);
