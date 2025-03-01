/**
 * useTodo
 *
 * @package hooks
 */

import { deleteTodoApi, fetchTodoListApi } from '@/apis/todoApi';
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
    if (res.success) {
      setOriginTodoList(res?.data && typeof res.data === 'object' ? res.data : []);
    }
  }, [isAuth]);

  /**
   * todoを削除
   * @param { number } todoId
   */
  const deleteTodo = useCallback(
    async (todoId: number) => {
      const res = await deleteTodoApi(todoId);
      if (!res.data || typeof res.data !== 'object') return;
      // todoを削除したtodo listで更新
      setOriginTodoList(originTodoList.filter((todo) => todo.id !== res?.data?.id));
    },
    [isAuth]
  );

  useEffect(() => {
    if (isAuth) fetchTodoList();
  }, [fetchTodoList, isAuth]);

  return { originTodoList, deleteTodo };
};
