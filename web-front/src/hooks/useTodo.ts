/**
 * useTodo
 *
 * @package hooks
 */

import { useAuthContext } from '@/contexts/AuthContext';
import { TodoType } from '@/interfaces/Todo';
import { useCallback, useState } from 'react';

/**
 * useTodo
 */
export const useTodo = () => {
  const { isAuth } = useAuthContext();
  /** todo list */
  const [originTodoList, setOriginTodoList] = useState<Array<TodoType>>([]);

  /** actions */
  const fetchTodoList = useCallback(() => {
    const res = await fetchTodoListApi();
    if (!isAuth) return;
    const todoList = await getTodoList();
    setOriginTodoList(todoList);
  }, [isAuth]);
};
