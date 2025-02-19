/**
 * useTodo
 *
 * @package hooks
 */

import { fetchTodoListApi } from '@/apis/todoApi';
import { useAuthContext } from '@/contexts/AuthContext';
import { TodoType } from '@/interfaces/Todo';
import { useCallback, useEffect, useState } from 'react';

/**
 * useTodo
 */
export const useTodo = () => {
  const { isAuth } = useAuthContext();
  /** todo list */
  const [originTodoList, setOriginTodoList] = useState<Array<TodoType>>([]);

  const fetchTodoList = useCallback(async () => {
    const res = await fetchTodoListApi();
    setOriginTodoList(res?.data && typeof res.data === 'object' ? res.data : []);
  }, [isAuth]);

  useEffect(() => {
    if (isAuth) fetchTodoList();
  }, [fetchTodoList, isAuth]);

  return { originTodoList };
};
