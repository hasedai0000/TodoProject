/**
 * BaseLayout
 *
 * @package components
 */

import { FC } from 'react';

import styles from './styles.module.css';
import { TodoType } from '@/interfaces/Todo';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faPenToSquare, faTrash, faTrashAlt } from '@fortawesome/free-solid-svg-icons';

type Props = {
  todoList: Array<TodoType>;
};

/**
 * BaseLayout
 */
export const TodoList: FC<Props> = ({ todoList }) => {
  return (
    <ul className={styles.list}>
      {todoList.map((todo) => (
        <li key={todo.id} className={styles.todo}>
          <span className={styles.task}>{todo.title}</span>
          <div className={styles.area}>
            <div className={styles.far}>
              <FontAwesomeIcon icon={faTrash} size="lg" />
            </div>
            <div className={styles.far}>
              <FontAwesomeIcon icon={faPenToSquare} size="lg" />
            </div>
            <div className={styles.far}>
              <FontAwesomeIcon icon={faTrashAlt} size="lg" />
            </div>
          </div>
        </li>
      ))}
    </ul>
  );
};
