/**
 * useTodoDetailTemplate
 *
 * @package hooks
 */

import { fetchTodoDetailApi } from '@/apis/todoApi';
import { TodoType } from '@/interfaces/Todo';
import { useRouter } from 'next/router';
import { useCallback, useEffect, useState } from 'react';

type StatesType = {
  todo: TodoType | undefined;
};

/**
 * useTodoDetailTemplate
 */
export const useTodoDetailTemplate = () => {
  const router = useRouter();
  const [todo, setTodo] = useState<TodoType | undefined>(undefined);

  /**
   * fetchTodoDetail
   */
  const fetchTodoDetail = useCallback(async () => {
    const targetId = router?.query?.id;
    if (!!targetId && typeof targetId === 'string' && !Number.isNaN(Number(targetId))) {
      const res = await fetchTodoDetailApi(Number(targetId));
      setTodo(res?.data && typeof res.data === 'object' ? res.data : undefined);
    }
  }, [router]);

  useEffect(() => {
    fetchTodoDetail();
  }, [fetchTodoDetail]);

  const states: StatesType = {
    todo,
  };

  return [states] as const;
};
