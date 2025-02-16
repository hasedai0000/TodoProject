/**
 * Navigation
 *
 * @package components
 */

import { FC } from 'react';
import { useAuthContext } from '@/contexts/AuthContext';
import styles from './styles.module.css';
import { useNavigation } from './useNavigation';

export const Navigation: FC = () => {
  const { signOut } = useAuthContext();
  const { handleLogout } = useNavigation({ signOut });

  return (
    <div className={styles.header}>
      <h1 className={styles.title}>Todo List</h1>
      <nav className={styles.nav}>
        <ul className={styles.ul}>
          <li className={styles.li}>
            <button className={styles.button} onClick={handleLogout}>
              SignOut
            </button>
          </li>
        </ul>
      </nav>
    </div>
  );
};
